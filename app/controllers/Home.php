<?php

    class Home extends Controller {
        public function index(){
            $db = new Database();
            $res = $db->query(("select * from users"));

            show($res);
            
            $users = new Users();
            $users -> insert($data);

            $data['title'] = 'Home';
            $this->view('home',$data);
        }

    }

