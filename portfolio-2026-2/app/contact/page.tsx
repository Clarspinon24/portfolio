import "../globals.css";

export default function Contact() {
  return (
  <>
      <form method="POST" className="form_contact" >
        <label htmlFor="firstname">Firstname : </label>
        <input type="text" name="firstname" id="firstname" placeholder="John" />
        <br />
        <label htmlFor="lastname">Lastname : </label>
        <input type="text" name="lastname" id="lastname" placeholder="Doe" />
        <br />
        <label htmlFor="email">Email : </label>
        <input
          type="email"
          name="email"
          id="email"
          placeholder="john.doe@gmail.com"
        />
        <br />
        <label htmlFor="message">Message : </label>
        <input type="text" name="message" id="message" />
        <br />
        <input type="submit" name="register" value="Register" />
      </form>
    
    </>
  );
}
  