<?php
class Mailer
{
    private $sender = "From:phoenix.trust.bank.0101@gmail.com";


 
    public function sendMail($receiver,$subject,$body)

    {
        // $senderr = "From:phoenix.trust.bank.0101@gmail.com";
        // $subject = "test subject";
        // $body = "test body";


        $result = mail($receiver,$subject,$body,$this->sender);
       // $result = mail($receiver,$subject,$body,$senderr);
        if($result)
        {
            echo ("Success");
        }
        else
        {
            echo("Error");
        }
    }
    public function generateMailBody($accountNo,$password,$accountType)
    {
        $body = "Your ".$accountType." was successfully created under account No: ".$accountNo." . This is your password: ".$password." .Do not share it with anyone.";

        return $body;
    }
    public function generateMailSubject($accountType)
    {

        $subject = $accountType." successfully created";

        return $subject;
    }
}
// $receiver = "jithmi.nawoda01@gmail.com";
// $subject ="test subject";
// $body = "test body";
// $sender = "From:phoenix.trust.bank.0101@gmail.com";

// if(mail($receiver,$subject,$body,$sender))
// {
//     echo("success");
// }
// else
// {
//     echo("Error");
// }


?>

