<?php

class Monografia
{
    private $_db;
    private $_data;
    private $_sessionName;
    private $_cookieName;
    private $_isLoggedIn;

    public function __construct($user = null)
    {
        $this->_db = DB::getInstance();
    }

    public function update($fields = array(), $id = null)
    {

        if (!$this->_db->update('monografia', $id, $fields)) {
            throw new Exception('There was a problem updating.');
        }
    }

    public function create($fields = array())
    {
        if (!$this->_db->insert('monografia', $fields)) {
            throw new Exception('houve um problema ao registrar a monografia.');
        }
    }

    public function monografias() {
            $data = $this->_db->get('monografia', null);
            if ($data->count()) {
                $this->_data = $data->results();
                return true;
            }

        return false;
    }

    public function find($tema = null)
    {
        if ($tema) {
            $field = (is_numeric($tema)) ? 'id' : 'tema';
            $data = $this->_db->get('monografia', array($field, '=', $tema));

            if ($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }

        return false;
    }


    public function delete($id){
        
        if ($id) {
            $this->_db->delete('monografia', array('id','=', $id));
            return true;
        }

        return false;
    }
    public function exists()
    {
        return (!empty($this->_data)) ? true : false;
    }

    public function data()
    {
        return $this->_data;
    }

    public function isLoggedIn()
    {
        return $this->_isLoggedIn;
    }
}