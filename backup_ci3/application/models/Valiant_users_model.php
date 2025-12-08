<?php

class Valiant_users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function loginCheck($values)
    {
        $arr = array(
            'username' => $values['username'],
            'password' => md5($values['password']),
        );
        $this->db->where($arr);
        $result = $this->db->get('ch_users');
        $resultArray = $result->row_array();
        if ($result->num_rows() > 0) {
            $this->db->where('id', $resultArray['id']);
            $this->db->update('ch_users', array('last_login' => time()));
        }
        return $resultArray;
    }

    /*
     * Some statistics methods for home page of
     * administration
     * START
     */


    public function lastSubscribedEmailsCount()
    {
        $yesterday = strtotime('-1 day', time());
        $this->db->where('time > ', $yesterday);
        return $this->db->count_all_results('subscribed');
    }

   
    /*
     * Some statistics methods for home page of
     * administration
     * END
     */

    public function setValueStore($key, $value)
    {
        $this->db->where('thekey', $key);
        $query = $this->db->get('value_store');
        if ($query->num_rows() > 0) {
            $this->db->where('thekey', $key);
            if (!$this->db->update('value_store', array('value' => $value))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (!$this->db->insert('value_store', array('value' => $value, 'thekey' => $key))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function changePass($new_pass, $username)
    {
        $this->db->where('username', $username);
        $result = $this->db->update('ch_users', array('password' => bcrypt($new_pass)));
        return $result;
    }

    public function getValueStore($key)
    {
        $query = $this->db->query("SELECT value FROM value_store WHERE thekey = '$key'");
        $img = $query->row_array();
        return $img['value'];
    }

    public function newOrdersCheck()
    {
        $result = $this->db->query("SELECT count(id) as num FROM `orders` WHERE viewed = 0");
        $row = $result->row_array();
        return $row['num'];
    }

    public function setCookieLaw($post)
    {
        $query = $this->db->query('SELECT id FROM cookie_law');
        if ($query->num_rows() == 0) {
            $update = false;
        } else {
            $result = $query->row_array();
            $update = $result['id'];
        }

        if ($update === false) {
            $this->db->trans_begin();
            if (!$this->db->insert('cookie_law', array(
                        'link' => $post['link'],
                        'theme' => $post['theme'],
                        'visibility' => $post['visibility']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $for_id = $this->db->insert_id();
            $i = 0;
            foreach ($post['translations'] as $translate) {
                if (!$this->db->insert('cookie_law_translations', array(
                            'message' => htmlspecialchars($post['message'][$i]),
                            'button_text' => htmlspecialchars($post['button_text'][$i]),
                            'learn_more' => htmlspecialchars($post['learn_more'][$i]),
                            'abbr' => $translate,
                            'for_id' => $for_id
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                $i++;
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                show_error(lang('database_error'));
            } else {
                $this->db->trans_commit();
            }
        } else {
            $this->db->trans_begin();
            $this->db->where('id', $update);
            if (!$this->db->update('cookie_law', array(
                        'link' => $post['link'],
                        'theme' => $post['theme'],
                        'visibility' => $post['visibility']
                    ))) {
                log_message('error', print_r($this->db->error(), true));
            }
            $i = 0;
            foreach ($post['translations'] as $translate) {
                $this->db->where('for_id', $update);
                $this->db->where('abbr', $translate);
                if (!$this->db->update('cookie_law_translations', array(
                            'message' => htmlspecialchars($post['message'][$i]),
                            'button_text' => htmlspecialchars($post['button_text'][$i]),
                            'learn_more' => htmlspecialchars($post['learn_more'][$i])
                        ))) {
                    log_message('error', print_r($this->db->error(), true));
                }
                $i++;
            }
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                show_error(lang('database_error'));
            } else {
                $this->db->trans_commit();
            }
        }
    }

    public function getCookieLaw()
    {
        $arr = array('cookieInfo' => null, 'cookieTranslate' => null);
        $query = $this->db->query('SELECT * FROM cookie_law');
        if ($query->num_rows() > 0) {
            $arr['cookieInfo'] = $query->row_array();
            $query = $this->db->query('SELECT * FROM cookie_law_translations');
            $arrTrans = $query->result_array();
            foreach ($arrTrans as $trans) {
                $arr['cookieTranslate'][$trans['abbr']] = array(
                    'message' => $trans['message'],
                    'button_text' => $trans['button_text'],
                    'learn_more' => $trans['learn_more']
                );
            }
        }
        return $arr;
    }

    public function deleteAdminUser($id)
    {
        $this->db->where('id', $id);
        if (!$this->db->delete('ch_users')) {
            log_message('error', print_r($this->db->error(), true));
            show_error(lang('database_error'));
        }
    }

    public function getAdminUsers($user = null)
    {
        if ($user != null && is_numeric($user)) {
            $this->db->where('id', $user);
        } else if ($user != null && is_string($user)) {
            $this->db->where('username', $user);
        }
        $query = $this->db->get('ch_users');
        if ($user != null) {
            return $query->row_array();
        } else {
            return $query;
        }
    }

    public function getUsers()
    {
        $query = $this->db->get('ch_users');
        return $query->row_array()->id;

    }

    public function getuserid($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('ch_users');
        // return $query->result()->id;
        foreach ($query->result_array() as $row)
        {
            $id = $row['id'];
        }

        return $id;

    }

    public function getusersinfo()
    {
        $this->db->select('ch_users.id as id, ch_users.fname as fname, ch_users.lname, ch_users.email, ch_users.phoneno, ch_users.residence, ch_users.gender as gender, ch_users.phoneno, ch_users.profession, ch_progress.position, ch_progress.contribution, ch_progress.monthly_contrb_status as status');
        // ch_progress // ch_users
        $this->db->join('ch_progress', 'ch_progress.user_id = ch_users.id', 'left');
        
        $query = $this->db->get('ch_users');

        // var_dump($query); exit;

        return $query->result_array();
    }

    public function setAdminUser($post)
    {
        // var_dump($post); exit;
        if ($post['edit'] > 0) {
            if (trim($post['password']) == '') {
                unset($post['password']);
            } else {
                $post['password'] = md5($post['password']);
            }
            $this->db->where('id', $post['edit']);
            unset($post['id'], $post['edit']);
            if (!$this->db->update('ch_users', $post)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            unset($post['edit']);
            $post['password'] = md5($post['password']);
            if (!$this->db->insert('ch_users', $post)) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }

    public function saveposVote($data)
    {
        $userid = $data['user_id'];
        $position = $data['position']['row'];
        $username = $data['username'];

        // var_dump($userid);  echo "<br>";
        // var_dump($position);exit;
        $this->db->where('user_id', $userid);
        $query = $this->db->get('ch_progress');
        if ($query->num_rows() > 0) {
            $this->db->where('user_id', $userid);
            if (!$this->db->update('ch_progress', array('position' => $position))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        } else {
            if (!$this->db->insert('ch_progress', array(
                    'user_id' => $userid,
                    'position' => $position
            ))) {
                log_message('error', print_r($this->db->error(), true));
                show_error(lang('database_error'));
            }
        }
    }
     

}
