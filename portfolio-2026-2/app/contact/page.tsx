import "../globals.css";
import Form from 'next/form'

export default function Contact() {
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