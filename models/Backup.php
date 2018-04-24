<?php

class Backup extends ActiveRecord\Model
{
    private $types = array(
        0 => 'Diario',
        1 => 'Semanal',
        2 => 'Mensual',
    );

    private $states = array(
        0 => 'Funcionando',
        1 => 'Pausado',
        2 => 'Eliminado',
    );

    static $belongs_to = array(
        array('user'),
    );

    /*
    *   Public Methods
    */
    public function get_type_text()
    {
        return $this->types[$this->type];
    }

    public function get_types()
    {
        return $this->types;
    }

    public function get_state_text()
    {
        return $this->states[$this->state];
    }

    public function get_states()
    {
        return $this->states;
    }

    public function build_cronjob($cronjob)
    {
        $cron_string = array();

        if (count($cronjob['cron_minutes']) > 0)
        {
            $cron_string['minutes'] = implode(',', $cronjob['cron_minutes']);
        }
        else
        {
            $cron_string['minutes'] = '*';
        }

        if (count($cronjob['cron_hours']) > 0)
        {
            $cron_string['hours'] = implode(',', $cronjob['cron_hours']);
        }
        else
        {
            $cron_string['hours'] = '*';
        }

        if (count($cronjob['cron_days']) > 0)
        {
            $cron_string['days'] = implode(',', $cronjob['cron_days']);
        }
        else
        {
            $cron_string['days'] = '*';
        }

        if (count($cronjob['cron_months']) > 0)
        {
            $cron_string['months'] = implode(',', $cronjob['cron_months']);
        }
        else
        {
            $cron_string['months'] = '*';
        }

        if (count($cronjob['cron_week_days']) > 0)
        {
            $cron_string['week_days'] = implode(',', $cronjob['cron_week_days']);
        }
        else
        {
            $cron_string['week_days'] = '*';
        }

        return implode(' ', $cron_string);
    }

    public function get_cronjob_minutes()
    {
        if ($this->cronjob != NULL)
        {
            $parts = explode(" ", $this->cronjob);

            if ($parts == "*")
            {
                return array();
            }
            else
            {
                return explode(",", $parts[0]);
            }
        }

        return array();
    }

    public function get_cronjob_hours()
    {
        if ($this->cronjob != NULL)
        {
            $parts = explode(" ", $this->cronjob);

            if ($parts == "*")
            {
                return array();
            }
            else
            {
                return explode(",", $parts[1]);
            }
        }

        return array();
    }

    public function get_cronjob_days()
    {
        if ($this->cronjob != NULL)
        {
            $parts = explode(" ", $this->cronjob);

            if ($parts == "*")
            {
                return array();
            }
            else
            {
                return explode(",", $parts[2]);
            }
        }

        return array();
    }

    public function get_cronjob_months()
    {
        if ($this->cronjob != NULL)
        {
            $parts = explode(" ", $this->cronjob);

            if ($parts == "*")
            {
                return array();
            }
            else
            {
                return explode(",", $parts[3]);
            }
        }

        return array();
    }

    public function get_cronjob_week_days()
    {
        if ($this->cronjob != NULL)
        {
            $parts = explode(" ", $this->cronjob);

            if ($parts == "*")
            {
                return array();
            }
            else
            {
                return explode(",", $parts[4]);
            }
        }

        return array();
    }

    public function get_custom_cronjob()
    {
        if ($this->cronjob != NULL)
        {
            return $this->cronjob." /usr/bin/wget -q ".WEBSITE_HOST."backups/cronjob/".$this->id." # TFG Admin Script ".$this->id;
        }

        return NULL;
    }
}
