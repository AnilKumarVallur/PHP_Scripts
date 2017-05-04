<?php
	require_once 'php_classes/class.phpmailer.php';
	require_once 'php_classes/class.smtp.php';
	

    /* $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
    $username = '82ssraichur@gmail.com';
    $password = '82ssr2016'; */
	
	
	$hostname = '{outlook.office365.com:993/imap/ssl}INBOX';
    $username = 'ankv@cypress.com';
    $password = 'anilreddy@3992';

    /* try to connect */
    $inbox = imap_open($hostname,$username,$password) or die('Cannot connect to the client: ' . imap_last_error());

    /* grab emails */
    $emails = imap_search($inbox,'UNSEEN');

    /* if emails are returned, cycle through each... */
    if($emails) {
        
        /* begin output var */
        $output = '';
        
        /* put the newest emails on top */
        //rsort($emails);
        $number = 0;
        
        /* for every email... */
        foreach($emails as $email_number) {
            
            /* get information specific to this email */
            $overview = imap_fetch_overview($inbox,$email_number,0);

            if($overview[0]->seen){
				
            }
            else{
                $number = $number+1;
                $from = $overview[0]->from;
				
				$header = imap_headerinfo($inbox, $email_number);
				$subject = $header->Subject;
				$fromaddress = $header->from[0]->mailbox . "@" . $header->from[0]->host;
				if (strpos($header->from[0]->host, "cypress.com") !== false) {
					
					$dir = "documents/";

					// Open a directory, and read its contents
					if (is_dir($dir)){
					  if ($dh = opendir($dir)){
						while (($file = readdir($dh)) !== false){
						  echo "filename:" . $file . "<br>";
						}
						closedir($dh);
					  }
					}
					
					if (stripos($subject, "welcome letter") !== false) {
						echo "From E-Mail Address : ".$fromaddress."<br/>";
						echo "Subject : ".$subject."<br/>";
					
						$mail1 = new PHPMailer();

						/*$mail1->IsSMTP();
						
						$mail1->SMTPAuth = false;
						$mail1->Host = "abcd.com";
						$mail1->Port = 25;
						
						$mail1->SetFrom("getdocs@cypress.com","Get Any Documents");
						$mail1->AddAddress($fromaddress);
						
						$mail1->Subject = "Welcome Letter";
						$mail1->MsgHTML("<p>Your Welcome letter is attached with this email.</p>");
						$mail1->addattachment("welcome_letter.pdf");
						
						$mail1->Send();
						$status = imap_setflag_full($inbox, $email_number, "\\Seen");*/
					}
				}else {
						echo "No new emails with the subject welcome letter<br/>";
				}
            }
            
        }
        
        //echo $output;
        //echo "Number of unread emails:".$number;
    }else {
		echo "There are no new emails<br/>";
	}

    /* close the connection */
    imap_close($inbox);      
?>
