<?php
namespace App\Library;

use App\JwtTokens;

use Firebase\JWT\JWT;

class ManagerJWT
{
    private $KEY = '';
    private $TYPE_HASH = '';

    public function __construct()
    {
        $this->KEY = Config("services.JWT_TOKEN.KEY");
        $this->TYPE_HASH = Config("services.JWT_TOKEN.TYPE_HASH");
    }

    public function loginUser($user_id)
    {
        $response = false;

        $time = time();
        
        $iss = "App";
        $iat = $time;
        $nbf = $time;
        $exp = $time + (60 * ((60 * 24) * 30)); // 30 DIAS VENCE!

        $iat_db = new \DateTime();
        $iat_db->setTimestamp($iat);
        $nbf_db = new \DateTime();
        $nbf_db->setTimestamp($nbf);
        $exp_db = new \DateTime();
        $exp_db->setTimestamp($exp);

        // NO PERMITE MULTIPLE SESSIONES DADO QUE ES UNA APP :)
        $token_access = JwtTokens::where("sub",$user_id)->first();

        if(!$token_access)
        {
            $token_access = new JwtTokens();
        }

        $token_access->iss = $iss;
        $token_access->sub = $user_id;
        $token_access->iat = $iat_db->format('Y-m-d H:i:s');
        $token_access->nbf = $nbf_db->format('Y-m-d H:i:s');
        $token_access->exp = $exp_db->format('Y-m-d H:i:s');
        $token_access->save();

        $token = array(
            'iss'=> $iss,
            "sub"=> $user_id, // user
            "iat"=> $iat, // tiempo en el que fue emitido
            "nbf"=> $iat, // tiempo a partir que es válido
            "exp"=> $exp // tiempo en el que expira
        );

        $jwt = JWT::encode($token, $this->KEY);

        return $jwt;
    }

    public function validateToken($token)
    {
        $response_estructure = new ResponseEstructure();
        $response_estructure->set_response(false);

        if(trim($token) != "")
        {
            try
            {
                $data = JWT::decode($token, $this->KEY, array($this->TYPE_HASH));
                
                if($data)
                {
                    $iat_db = new \DateTime();
                    $iat_db->setTimestamp($data->iat);
                    $iat_db = $iat_db->format('Y-m-d H:i:s');

                    $nbf_db = new \DateTime();
                    $nbf_db->setTimestamp($data->nbf);
                    $nbf_db = $nbf_db->format('Y-m-d H:i:s');

                    $exp_db = new \DateTime();
                    $exp_db->setTimestamp($data->exp);
                    $exp_db = $exp_db->format('Y-m-d H:i:s');
                    
                    $token_access = JwtTokens::where("iss",$data->iss)
                    ->where("sub",$data->sub)
                    ->where("iat",$iat_db)
                    ->where("nbf",$nbf_db)
                    ->where("exp",$exp_db)
                    ->first();

                    if($token_access)
                    {
                        $response_estructure->set_login(true);
                        $response_estructure->set_id_usuario($data->sub);
                        $response_estructure->set_response(true);
                    }
                }
            }
            catch(\Firebase\JWT\UnexpectedValueException $e)
            {

            }
            catch(\Firebase\JWT\SignatureInvalidException $e)
            {

            }
            catch(\Firebase\JWT\BeforeValidException $e)
            {

            }
            catch(\Firebase\JWT\ExpiredException $e)
            {
                
            }
            catch(Exception $e)
            {

            }
        }

        return $response_estructure;
    }

    public function logout($token)
    {
        $response = false;

        try
        {
            $data = JWT::decode($token, $this->KEY, array($this->TYPE_HASH));
            
            if($data)
            { 
                $iat_db = new \DateTime();
                $iat_db->setTimestamp($data->iat);
                $iat_db = $iat_db->format('Y-m-d H:i:s');

                $nbf_db = new \DateTime();
                $nbf_db->setTimestamp($data->nbf);
                $nbf_db = $nbf_db->format('Y-m-d H:i:s');

                $exp_db = new \DateTime();
                $exp_db->setTimestamp($data->exp);
                $exp_db = $exp_db->format('Y-m-d H:i:s');
                
                $token_access = JwtTokens::where("iss",$data->iss)
                ->where("sub",$data->sub)
                ->where("iat",$iat_db)
                ->where("nbf",$nbf_db)
                ->where("exp",$exp_db)
                ->first();

                if($token_access)
                {
                    $token_access->delete();
                }

                $response = true;
            }
        }
        catch(\Firebase\JWT\UnexpectedValueException $e)
        {
            
        }
        catch(\Firebase\JWT\SignatureInvalidException $e)
        {

        }
        catch(\Firebase\JWT\BeforeValidException $e)
        {

        }
        catch(\Firebase\JWT\ExpiredException $e)
        {
            
        }
        catch(Exception $e)
        {

        }

        return $response;
    }
}