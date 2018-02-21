<?php
defined('BASE_PATH') OR exit('No direct script access allowed');

class Loader {

    private $notifications = array();

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

    function redirect($url = NULL)
    {
        if ( ! $url)
        {
            $url = BASE_CONTROLLER."/".BASE_ACTION;
        }

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

    function new_notification($message, $type = 'info')
    {
        if ( ( strlen($message) > 0 )
            &&
            (($type == 'info')||($type == 'success')||($type == 'danger')||($type == 'warning'))
        )
        {
            array_push($this->notifications, array(
                    'message'   => $message,
                    'type'      => $type
                )
            );
        }
    }

    function get_notifications()
    {
        $html_notifications = '';

        if (count($this->notifications) > 0 )
        {
            foreach($this->notifications as $notification)
            {
                $html_notifications = $html_notifications.$this->load->view("common/".$notification['type'], array('message' => $notification['message']));
            }

            return $html_notifications;
        }

        return NULL;
    }
}
