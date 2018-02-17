<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Loader {

    function __construct()
    {
    }

    function view($view, $data = array())
    {
        foreach ($data as $id_assoc => $value)
        {
            ${$id_assoc} = $value;
        }

        $this->load = $this;

        require_once(BASE_PATH.'/views/'.$view.'.php');
    }

    function redirect($url = '')
    {
        header('Location: /'.$url);
    }

    function get_value($index = NULL)
    {
        $params = explode( "/", $_GET['params']);
        return $this->_get_value_array($params, $index);
    }

    function post_value($index = NULL)
    {
        $params = $_POST;
        return $this->_get_value_array($params, $index);
    }

    private function _get_value_array($array, $index = NULL)
    {
		isset($index) OR $index = array_keys($array);

		if (is_array($index))
		{
			$output = array();
			foreach ($index as $key)
			{
				$output[$key] = $this->_get_value_array($array, $key);
			}

			return $output;
		}

		if (isset($array[$index]))
		{
			$value = $array[$index];
		}
		elseif (($count = preg_match_all('/(?:^[^\[]+)|\[[^]]*\]/', $index, $matches)) > 1)
		{
			$value = $array;
			for ($i = 0; $i < $count; $i++)
			{
				$key = trim($matches[0][$i], '[]');
				if ($key === '')
				{
					break;
				}

				if (isset($value[$key]))
				{
					$value = $value[$key];
				}
				else
				{
					return NULL;
				}
			}
		}
		else
		{
			return NULL;
		}

		return $value;
    }
}
