<?php
namespace App\Providers;
class LogServiceProvider{
    static function newLog(int $id){
        $file = fopen('../storage/logs/logging/'.$id.'.txt', "w");
        fwrite($file, "Job with id=".$id." has been create on ".date("Y-m-d H:i:s").PHP_EOL);
        fclose($file);
    }
    static function applied(int $id, int $candidateID){
        $file = fopen('../storage/logs/logging/'.$id.'.txt', "a");
        fwrite($file, "Candidate with id=".$candidateID." has applied for this job role on ".date("Y-m-d H:i:s").PHP_EOL);
        fclose($file);
    }
    static function schedule( $id,  $candidateID,  $time){
        $file = fopen('../storage/logs/logging/'.$id.'.txt', "a");
        fwrite($file, "Interview has been scheduled for Candidate with id=".$candidateID." on ".$time." a mail has been sent to inform them.".PHP_EOL);
        fclose($file);
    }
   
}