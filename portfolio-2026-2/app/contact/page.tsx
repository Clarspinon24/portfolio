import "../globals.css";
import Form from 'next/form'
import { Resend } from 'resend';

export default function Contact() {

const resend = new Resend('re_dePCrHJC_BT4EkEuRH72P8RpTZacKdkhr');
const message = ;

resend.emails.send({
  from: 'onboarding@resend.dev',
  to: 'marchal.clara95@gmail.com',
  subject: 'Contact',
  html: '<p>{message}</p>'
});
 
  return (

    <> {/* Début du fragment obligatoire */}

   <h1>Contact</h1>
    <Form action="">
      
      <input type="text" name ="pseudo" placeholder="pseudo"/>
      <input type="email" name="email" placeholder="email"/>
      <input type="password" name="password" placeholder="mot de passe"/>
      <textarea 
        id="message" 
        name="message" 
        placeholder="Message"
        className="block-message">
      </textarea>
      <button type="submit">Envoyer le message</button>
    </Form>
  
    
    
    </> // Fin du fragment obligatoire
  );
}