<?php

class view
{
	
	function generate($template_view, $data = null)
	{
		include 'application/views/'.$template_view;
	}
}
