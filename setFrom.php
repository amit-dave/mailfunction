
app.php 

'EmailTransport' => [
        'default' => [
            'className' => MailTransport::class,
            /*
             * The keys host, port, timeout, username, password, client and tls
             * are used in SMTP transports
             */
            'host' => 'smtp.gmail.com',
            'port' => 25,
            'timeout' => 30,
             'client' => null,
            /*
             * It is recommended to set these options through your environment or app_local.php
             */
            'username' => 'dummy@gmail.com',
            'password' => 'dummy',
            'client' => null,
            'tls' => true,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
        'mailjet' => [
           'host' => 'ssl://smtp.gmail.com',
           'port' => 465,//your ssl or none ssl port no465
           // 'from' => ['no-reply@test.pp' => 'My Site'],
           'username' => 'dummy@gmail.com', //your smtp mail id
           'password' => 'dummy', //your email password
           'timeout' => 30,
           'secure' => 'ssl',
           'tls' => false,
           'className' => 'Smtp',
           'log' => true,
        ]
    ],

  controller
  use Cake\Mailer\Mailer;
function mailSend(){
  $to = 'test@gmail.com';//$user['email'];
        $name = $user['fullname'];
        $password = $user['password'];
        
        $subject = "パスワード再設定のご案内";
        $mailer = new Mailer('default');
        $mailer->setTransport('mailjet');
        // $mailer = new Email('default');
        // $mailer->getTransport('mailjet');
        $params = array('sendAs'=>'text', 'template'=>'forgot', 'subject'=>$subject, 'additional'=>array('name', $name, 'password', $password));
        $mailer->setFrom(['info@test.pp' => 'My Site']);
        $mailer->setSender('info@test.pp');
          $mailer->setTo($to);
          $mailer->setEmailFormat('html');
          $mailer->setSubject($subject);
          $mailer->viewBuilder()->setTemplate('forgot');
          $mailer->setViewVars($params);
        // ViewBuilder::setTemplate('email_template')
          // $mailer->setTemplate('emailTemplate');
          // $mailer->setLayout('emailTemplate');
          echo "<pre>";
          print_r($mailer);
          $mailer->deliver();
          die();

        }



