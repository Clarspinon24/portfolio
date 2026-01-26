import "../globals.css";
import Form from 'next/form'

export default function Contact() {
  return (

    <> {/* Début du fragment obligatoire */}

   <h1>Contact</h1>
    <Form action="/search">
      {/* On submission, the input value will be appended to
          the URL, e.g. /search?query=abc */}
      <input name="query" />
      <button type="submit">Submit</button>
    </Form>
    </> // Fin du fragment obligatoire
  );
}