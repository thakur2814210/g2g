<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Lang;


class LanguageController extends Controller
{


	// Show all the language files contnet
	public function index(){
		$data = [];
		$modules = ['Admin' , 'Garage', 'Client' , 'Website'];
		$lang_arr = ['en','ar'];
		$lang_defualt_filename = 'defualt';

		$files_contents = [];
		foreach($modules as $k_m => $module ){
			foreach ($lang_arr as $lang_key) {
			
				$dir_path = base_path().'/Modules/'.$module.'/Resources/lang/'. $lang_key;

				$files = \File::files($dir_path);
				foreach ($files as $file) {
					 $file_content_arr = \File::getRequire($file->getPathname());
					 foreach($file_content_arr as $key => $value){
					 	$files_contents[$module][$key][$lang_key] = $value;
					 }
				}

			}
		}
		$data['modules'] = $modules;
		$data['languages_name'] = ['English' , 'Arabic'];
		$data['languages'] = $files_contents;
		//dd($data);
		return view('admin::language.list' , $data);
	}

	// language save...
     public function editTranslations(Request $request) {

	   $lang_key = $request->lang_key;
	   $arabic_lang_content = $request->arabic_lang_content;
	   $english_lang_content = $request->english_lang_content;
	   $lang_module = $request->lang_module;

	   if( !empty($lang_key) && !empty($arabic_lang_content) && !empty($english_lang_content)  && !empty($lang_module)){

	   }
	}


	 // language save...
     public function saveTranslations(Request $request) {

	    $locales = LaravelLocalization::getSupportedLocales();
	    foreach ($locales as $l => $lang) {
	        ${"array_$l"} = Lang::get('recipes', [], $l);
	        ${"array_$l"}[$key] = $request->$l;
	        uksort(${"array_$l"}, "strnatcasecmp");

	        $path = \App::langPath() . '/' . $l . '/recipes.php';
	        $output = "<?php\n\nreturn " . var_export(${"array_$l"}, true) . ";\n";

	        $f = new Filesystem();
	        $f->put($path, $output);
	    }

	    return redirect(LaravelLocalization::getCurrentLocale() . '/admin/translations');
	}



}