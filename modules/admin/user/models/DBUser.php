<?php
namespace modules\admin\user\models;
use models\database;

class DBUser extends database{

    public function insertUser($array){
        try{
            $stmt = $this->conn->prepare("INSERT INTO user(name, email, login, pass, id_tipo, id_multiplicador) VALUES(:name, :email, :login, :pass, :id_tipo, :id_multiplicador)");
            $stmt->execute($array);
            var_dump($stmt->errorInfo());
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }


    /**
     * return lastInsertId
     * ***/
    public function insertCadastro($array){
        try{
            //create sigin
            $stmt = $this->conn->prepare("INSERT INTO user(name, email, pass, cod_multiplicador, tel,tel2, uf, login) VALUES(:name, :email, :pass, :cod_multiplicador, :tel, :tel2, :uf, :login)");
            $stmt->execute($array);

            return $this->conn->lastInsertId();
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function insertTimeAvaliacao($array){
        try{
            $stmt = $this->conn->prepare("INSERT INTO validation(date_ini, date_fin, id_user, ativo) VALUES(:date_ini, :date_fin, :id_user, :ativo)");
            $stmt->execute($array);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
//update


  //todo essa classe tem um problema no servidor, onde o strinct standart esta bugado falando que essa classe precisa de dois parametos ..se não coocar ele da pau nas paginas qeu necessitam dele
    public function updateUser($query, $id){
        try{
            return $this->conn->query($query);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

//delete


    public function deleteUser($id){
        try{
            $stmt = $this->conn->prepare("DELETE FROM user WHERE id_user = '".$id."'");
            $stmt->execute();

            return true;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

//select


    public function selectAllUser(){ // retorna um array com as informações de acordo com o mês
        $rs = $this->conn->query("SELECT * FROM user join tipos on user.id_tipo=tipos.id_tipo order by name ASC");
        if(($rs == false) || ($rs == NULL))
            return false;

        return $rs;
    }


    public function selectAllUserOfType($type){ // retorna as informações dos usuaroios do multiplicador logado
        $rs = $this->conn->query("SELECT * FROM user join tipos on user.id_tipo=tipos.id_tipo where user.id_multiplicador = ".$type." order by name ASC");
        if(($rs == false) || ($rs == NULL))
            return false;

        return $rs;
    }

    public function selectUser($id){ // retorna um array com as informações de acordo com o mês
        return $this->conn->query("select * from user where id_user =".$id)->fetch(\PDO::FETCH_ASSOC);
    }

    public function selectCat(){ // retorna um array com as informações de acordo com o mês
        $stmt = $this->conn->prepare("SELECT * FROM tipos");
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
//:: crud user finished::

    public function existsUserForCodeMultiplicador($id){
        try{
            $stmt = $this->conn->query("SELECT cod_multiplicador FROM user WHERE cod_multiplicador = ".$id)->fetch(\PDO::FETCH_ASSOC);

            if($stmt == null)
                return true;

            return false;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function existsLoginOfUser($name){
        try{
            $stmt = $this->conn->query("SELECT login FROM user WHERE login = ".$name)->fetch(\PDO::FETCH_ASSOC);

            if($stmt == null)
                return true;

            return false;
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}