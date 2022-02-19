<?php
/***
 * Created by Patrick Karungari
 *
 * Github: https://github.com/patrick-Karungari
 * E-Mail: PKARUNGARI@GMAIL.COM
 */

namespace App\Entities;

use App\Models\Users;

class User extends \CodeIgniter\Entity
{
    public function setPassword($password)
    {
        $config = new \Config\Auth();
        $this->attributes['password'] = password_hash($password, PASSWORD_BCRYPT, ['cost' => $config->bcryptCost]);
    }

    public function getName()
    {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    public function getRefBy()
    {
        $ref = $this->attributes['referred_by'];
        if ($ref && is_numeric($ref)) {
            return (new Users())->find($ref);
        }

        return false;
    }

    public function getAvatarUrl()
    {
        if (!empty($this->attributes['avatar'])) {
            return base_url('uploads/avatars/' . $this->attributes['avatar']);
        }

        return base_url('assets/images/faces/face1.jpg');
    }

    public function getRoles()
    {
        return \Config\Services::auth()->getUsersGroups($this->attributes['id']);
    }

    /**
     * Users metadata
     */

    /****
     * @param mixed $meta_key Metadata Key
     * @param mixed $default The default value if metadata does not exist
     * @return bool|mixed
     */

    public function usermeta($meta_key, $default = false)
    {
        $val = \Config\Database::connect()->table('usersmeta')->getWhere(['userid' => $this->attributes['id'], 'meta_key' => $meta_key])->getRow('meta_value');

        return $val ? $val : $default;
    }

    public function update_usermeta($meta_key, $meta_value)
    {
        if ($this->usermeta_exists($meta_key)) {
            $result = \Config\Database::connect()->table('usersmeta')->where(['userid' => $this->attributes['id'], 'meta_key' => $meta_key])->update(['meta_value' => $meta_value]);
            if ($result) {
                return true;
            }

            return false;
        } else {
            return $this->add_usermeta($meta_key, $meta_value);
        }
    }

    public function add_usermeta($meta_key, $meta_value)
    {
        $result = \Config\Database::connect()->table('usersmeta')->insert(['userid' => $this->attributes['id'], 'meta_key' => $meta_key, 'meta_value' => $meta_value]);
        if ($result) {
            return true;
        }

        return false;
    }

    public function usermeta_exists($meta_key)
    {
        $result = \Config\Database::connect()->table('usersmeta')->getWhere(['userid' => $this->attributes['id'], 'meta_key' => $meta_key])->getRow();
        if ($result) {
            return true;
        }
        return false;
    }

    public function delete_usermeta($meta_key)
    {
        $result = \Config\Database::connect()->table('usersmeta')->where(['userid' => $this->attributes['id'], 'meta_key' => $meta_key])->delete();
        if ($result) {
            return true;
        }

        return false;
    }
    /**
     * PERMISSIONS
     */

    /**
     * Check user permission
     *
     * @param string $permission Permission to check
     * @return mixed|boolean True for allowed, false for denied
     */
    public function can(string $permission)
    {
        $ionAuth = new \App\Libraries\Auth();

        $capabilities = [];

        //Get group capabilities
        $groups = $ionAuth->getUsersGroups($this->attributes['id']);
        foreach ($groups as $group) {
            if ($cap = json_decode($group->capabilities, true)) {
                $capabilities = array_merge($capabilities, $cap);
            }
        }
        //Get user specific capabilities
        $caps = $this->usermeta('_user_capabilities', json_encode([]));
        if ($caps = json_decode($caps, true)) {
            $capabilities = array_merge($capabilities, $caps);
        }

        if (isset($capabilities[$permission]) && $capabilities[$permission] == 1) {
            $return = true;
        } else {
            $return = false;
        }
        //Give admin exclusive permissions
        if ($ionAuth->isAdmin($this->attributes['id'])) {
            $return = true;
        }

        return apply_filters('check_permission_' . $permission, $return);
        //return $return;
    }

    public function add_cap($permission, $allowed = 1)
    {
        $caps = $this->usermeta('_user_capabilities', json_encode([]));
        $caps = json_decode($caps, true);
        $caps[$permission] = $allowed;

        return $this->update_usermeta('_user_capabilities', json_encode($caps));
    }

    public function remove_cap($permission, $allowed = 1)
    {
        $caps = $this->usermeta('_user_capabilities', json_encode([]));
        $caps = json_decode($caps, true);
        unset($caps[$permission]);

        return $this->update_usermeta('_user_capabilities', json_encode($caps));
    }

    public function set_caps(array $capabilities = array())
    {

        $caps = $this->usermeta('_user_capabilities', json_encode([]));
        $caps = json_decode($caps, true);
        $caps = array_merge($caps, $capabilities);

        return $this->update_usermeta('_user_capabilities', json_encode($caps));
    }
}
