<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Section;
use App\SectionsDescription;

use DB;
use App\Models\Core\Setting;
use App\Models\Core\Language;
use Illuminate\Support\Facades\Lang;

class CategoryController extends Controller
{

    public function __construct( Setting $setting){
      $this->varseting = new \App\Http\Controllers\AdminControllers\SiteSettingController($setting);
      $this->Setting = $setting;
    }

    /*--------------------------------------------------------------
     -------------------- Manage Category --------------------
    ----------------------------------------------------------------*/


    public function allCategoryList()
    {

        $title = array('pageTitle' => Lang::get('labels.Manage Sections'));
        $result = array();
        $message = array();
        $errorMessage = array();

        $data = [];
        $language_id = 1;
        $data['categories'] = Section::with('sectionsDescription')->where('parent' , 0)->paginate(10);
        foreach ($data['categories'] as $key => $category) {
            foreach($category->sectionsDescription as $sd){
                if($sd->language_id == 1)
                    $category->name_en = $sd->sections_name;
                elseif($sd->language_id == 2)
                    $category->name_ar = $sd->sections_name;

            }       
        }



        $result['message'] = $message;
        $result['errorMessage'] = $errorMessage;
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin::category.category-list', $data , $title)->with('result', $result);
    }
    
    public function addCategory()
    {   
        $result = array();
        $message = array();
        $errorMessage = array();

        $result['message'] = $message;
        $result['errorMessage'] = $errorMessage;
        $result['commonContent'] = $this->Setting->commonContent();

        return view('admin::category.add-category')->with('result', $result);
    }

    public function saveCategory(Request $request)
    {   
        

        $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'slug' => 'required|unique:sections|max:255',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $category = new Section();
        $category->slug =!empty($request->name_en) ? $request->name_en : null;
        $category->slug =!empty($request->slug) ? $request->slug : null;
        $category->status = !empty($request->status) ? $request->status : null;
        $category->parent = 0;
        $category->cat_icon = !empty($request->cat_icon) ? $request->cat_icon : null;

        $category->description = !empty($request->description) ? $request->description : null;
        if($category->save()){

            // get languages
            $languages = DB::table('languages')->get();
            foreach ($languages as $language) {
                
                $sectionsDescription = new SectionsDescription();
                $sectionsDescription->sections_id = $category->id;
                $sectionsDescription->language_id = $language->languages_id;

                $sections_name = 'name_' . $language->code;
                $sectionsDescription->sections_name = $request->$sections_name;
                $sectionsDescription->save();
            }

            return \Redirect::back()->with('status', 'New category saved successfully !!!');
        }else{
            return \Redirect::back()->with('status', 'Something went wrong !!!');
        }

    }

    public function editCategory($id)
    {   
        
        $title = array('pageTitle' => Lang::get('labels.Manage Sections'));
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
       
        if(!empty($id)){
            $data = [];
            $data['categories'] = Section::where('id', $id)->first();
            if(!empty($data['categories'])){

                $sectionsDescription = SectionsDescription::where('sections_id', $id)->get();
                foreach ($sectionsDescription as  $sd) {
                   if($sd->language_id == 1){
                        $data['categories']['name_en'] = $sd->sections_name;
                   }
                   if($sd->language_id == 2){
                        $data['categories']['name_ar'] = $sd->sections_name;
                   }
                }
                //dd($data);die;
                return view('admin::category.edit-category', $data)->with('result', $result);
            }
        }
        


        return \Redirect::back()->with('status', 'Category does not exit !!!');
    }

    public function updateCategory(Request $request)
    {   

        //dump($request);die;
        

        $id = $request->id;
        $categories = Section::where('id', '=', $id)->first();
        if(!empty($categories)){


                $validator = Validator::make($request->all(), [
                    'name_en'   =>  [
                        'required',
                        'max:255'
                    ],
                    'name_ar'   =>  [
                        'required',
                        'max:255'
                    ],
                    'slug'   =>  [
                        'required',
                        'max:255',
                         Rule::unique('sections')->ignore($id),
                    ],

                ]);

                if ($validator->fails()) {
                    return  \Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                }
               
                Section::where('id', $id)
                    ->update([
                        'slug' => $request->slug,
                        'status' => $request->status,
                        'description' =>$request->description,
                        'cat_icon' => $request->cat_icon,
                        'parent' => 0,
                    ]);

                // get languages
                $languages = \DB::table('languages')->get();
                foreach ($languages as $language) {
                    $sections_name = 'name_' . $language->code;
                    SectionsDescription::where('sections_id', '=', $id)
                        ->where('language_id', '=', $language->languages_id)->update([
                          'sections_name' => $request->$sections_name
                    ]);
                }

                return \Redirect::back()->with('status', 'Update Category saved successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function deleteCategory($id)
    {   
        

        if(!empty($id)){
            // check also if sub category exist also
            $categories = Section::where('parent', '=', $id)->get()->toArray();
            if(empty($categories)){
                Section::where('id', $id)->update(['status' => 2]);
                return \Redirect::back()->with('status', 'Category deleted successfully !!!');
            }else{
                return \Redirect::back()->with('status', 'Error - Cannot be deleted, sub category exist');
            }
        }
       return \Redirect::back()->with('status', 'Category does not exit !!!');
    }


    /*--------------------------------------------------------------
     -------------------- Manage Sub Category --------------------
    ----------------------------------------------------------------*/

    public function allsubCategoryList(Request $request)
    {

        $title = array('pageTitle' => Lang::get('labels.Manage Sections'));
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
       
        
        $data = $allParentSections = $allParentSectionIds = [];
        $allSections = Section::with('sectionsDescription')->where('parent', 0)->get();
        foreach ($allSections as $key => $sec) {
            $allParentSectionIds[] = $sec->id;
            foreach($sec->sectionsDescription as $sd){
                if($sd->language_id == 1){
                    $allParentSections[$sec->id][$sd->language_id] = $sd->sections_name;
                }elseif($sd->language_id == 2){
                    $allParentSections[$sec->id][$sd->language_id] = $sd->sections_name;
                }

            }      
        }

        $sections = Section::with('sectionsDescription');
        if($request->has('id')){
             $sub_cate_id = $request->query('id');
             $cats = Section::where('id', '=', $sub_cate_id)->first();
             if(!empty($cats)){
                    $data['cat_name']  = $cats->name;
                    $data['categories'] =  $sections->where('parent' ,$sub_cate_id)->paginate(10);
                }
        }else{
            $data['categories'] =  $sections->where('parent' , '!=' , 0)->paginate(10);
        }
        foreach ($data['categories'] as $key => $category) {

            foreach($category->sectionsDescription as $sd){

                if($sd->language_id == 1){
                    $category->subsection_name_en = $sd->sections_name;
                }elseif($sd->language_id == 2){
                    $category->subsection_name_ar = $sd->sections_name;
                }

                if(in_array($category->parent, $allParentSectionIds)){
                    $category->section_name_en =$allParentSections[$category->parent][1];
                    $category->section_name_ar =$allParentSections[$category->parent][2];
                }
            }       
        }
        //dd($data['categories']);

       /*
        if($request->has('id')){
            $sub_cate_id = $request->query('id');
            if(!empty($sub_cate_id)){
                $cats = Section::where('id', '=', $sub_cate_id)->first();
                if(!empty($cats)){
                    $data['cat_name']  = $cats->name;
                    $data['is_single_cat_list']  = true;
                    //$data['categories'] = Section::where('parent' ,$sub_cate_id )->get();
                    $data['categories'] = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
                        ->where('sections_description.language_id', 1)
                        ->select('sections.*','sections_description.sections_name')
                        ->where('parent' ,$sub_cate_id )->get();
                }
            }
        }else{

            //$data['categories'] = Section::where('parent' , '!=' , 0)->paginate(20);
            $data['categories'] = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->where('sections_description.language_id', 1)
            ->select('sections.*','sections_description.sections_name')
            ->where('parent' , '!=' , 0)->get();
        }

          // dd($data['categories']);

         $data['parent_cats'] = Section::join('sections_description','sections_description.sections_id' , 'sections.id')
            ->where('sections_description.language_id', 1)
            ->select('sections.*','sections_description.sections_name as parent_name')
            ->where('parent'  , 0)->get();

        */
       
        return view('admin::category.subcategory-list', $data)->with('result', $result);
    }

    public function addSubCategory()
    {   

        $title = array('pageTitle' => Lang::get('labels.Manage Sections'));
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
       
        
        $data['categories'] = Section::where('status', 1)->get();
        return view('admin::category.add-subcategory' , $data)->with('result', $result);
    }

    public function saveSubCategory(Request $request)
    {   
       
         
         $validator = Validator::make($request->all(), [
            'name_en' => 'required',
            'name_ar' => 'required',
            'slug' => 'required|unique:sections|max:255',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
           return \Redirect::back()
                        ->withErrors($validator)
                        ->withInput();
        }


        $parent_cat_id = $request->parent;
        $parent_category = Section::where('id', $parent_cat_id)->first();
        $parent_type_id = $parent_category->type;

        $category = new Section();
        $category->name = !empty($request->name_en) ? $request->name_en : null;
        $category->slug =!empty($request->slug) ? $request->slug : null;
        $category->status = !empty($request->status) ? $request->status : null;
        $category->parent = !empty($request->parent) ? $request->parent : 0;;
        $category->description = !empty($request->description) ? $request->description : null;
        $category->cat_icon = null;
        $category->type = !empty($parent_type_id) ? $parent_type_id : 1;

        if($category->save()){

            // get languages
            $languages = DB::table('languages')->get();
            foreach ($languages as $language) {
                
                $sectionsDescription = new SectionsDescription();
                $sectionsDescription->sections_id = $category->id;
                $sectionsDescription->language_id = $language->languages_id;

                $sections_name = 'name_' . $language->code;
                $sectionsDescription->sections_name = $request->$sections_name;
                $sectionsDescription->save();
            }


            return \Redirect::back()->with('status', 'New sub category saved successfully !!!');
        }else{
            return \Redirect::back()->with('status', 'Something went wrong !!!');
        }
    }

    public function editSubCategory($id)
    {   
        
         $title = array('pageTitle' => Lang::get('labels.Manage Sections'));
        $result = array();
        $result['commonContent'] = $this->Setting->commonContent();
       

        if(!empty($id)){
            $data = [];
            $categories = Section::where('id', $id)->first();
            if(!empty($categories)){
                $data['categories'] = $categories;
                $data['allCategories'] = Section::where('status', 1)->get();
                $sectionsDescription = SectionsDescription::where('sections_id', $id)->get();
                foreach ($sectionsDescription as  $sd) {
                   if($sd->language_id == 1){
                        $data['categories']['name_en'] = $sd->sections_name;
                   }
                   if($sd->language_id == 2){
                        $data['categories']['name_ar'] = $sd->sections_name;
                   }
                }
                return view('admin::category.edit-subcategory', $data)->with('result', $result);
            }
        }
        return \Redirect::back()->with('status', 'Sub Category does not exit !!!');
    }

    public function updateSubCategory(Request $request)
    {   
       

        $id = $request->id;
        $categories = Section::where('id', '=', $id)->first();
        if(!empty($categories)){


                $validator = Validator::make($request->all(), [
                    'name_en'   =>  [
                        'required',
                        'max:255'
                    ],
                     'name_ar'   =>  [
                        'required',
                        'max:255'
                    ],
                    'slug'   =>  [
                        'required',
                        'max:255',
                         Rule::unique('sections')->ignore($id),
                    ]
                ]);

                if ($validator->fails()) {
                    return \Redirect::back()
                                ->withErrors($validator)
                                ->withInput();
                }


                $parent_cat_id = $request->parent;
                $parent_category = Section::where('id', $parent_cat_id)->first();
                $parent_type_id = $parent_category->type;
                
                Section::where('id', $id)
                    ->update([
                        'slug' => $request->slug,
                        'status' => $request->status,
                        'description' =>$request->description,
                        'parent' => $request->parent,
                        'type' => $parent_type_id,
                    ]);

                // get languages
                $languages = DB::table('languages')->get();
                foreach ($languages as $language) {
                    $sections_name = 'name_' . $language->code;

                    SectionsDescription::where('sections_id', '=', $id)
                        ->where('language_id', '=', $language->languages_id)->update([
                          'sections_name' => $request->$sections_name
                    ]);
                }

                return \Redirect::back()->with('status', 'Update Category saved successfully !!!');
        }
        return \Redirect::back()->with('status', 'Something went wrong !!!');
    }

    public function deleteSubCategory($id)
    {   
        
        if(!empty($id)){
            Section::where('id', $id)->update(['status' => 2]);
            return \Redirect::back()->with('status', 'Sub Category deleted successfully !!!');
        }
        return \Redirect::back()->with('status', 'Sub Category does not exit !!!');
    }


}
