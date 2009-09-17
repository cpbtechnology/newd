<?php
   class ModuleHelper extends AppHelper {
   	
	function render_module($title,$view_name,$url,$width,$height,$reloadable)
	{
		if($reloadable==true)
		{
			$reloadable="reloadable";
		}
		else
		{
			$reloadable="";
		}
echo '<div class="module" style="width:'.$width.'px;height:'.$height.'px"><h2>'.$title.'</h2><div class="content '.$reloadable.'" url="'.$url.'" id="'.hash('md5',$url).'">';
$view = ClassRegistry::getObject('view');
echo $view->renderElement($view_name,array("model"=>$this->requestAction($url)));
echo '</div></div>';
	}
   }
?>