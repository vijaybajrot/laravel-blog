<?php 

function flashMessage($message='',$level="info")
{
	session()->flash("flash_message",$message);
	session()->flash("flash_level",$level);
}


function getControllerInstance($name)
{
	//todo - get Controller instance
}