import "./globals.css";

export default function Home() {
  return (

    <> {/* Début du fragment obligatoire */}
   
   <div className="banderol"><h1 className="affiche">Clara Marchal</h1></div>
         <img
      className="siren"
      src="/asset/testSiren.png"
      alt="Picture of a siren draw by me"
     
    />
    <div className="text-home">
    <p>I am currently a student at IIM Digital School, specializing in Web Development.
     Passionate about solving complex problems, I have developed solid skills in Next.js 
     and various other frameworks through my academic projects. I am recognized for my ability
    to collaborate effectively within a team and for my serious commitment to my professional projects.</p>

    <p>My professional goal is to join an innovative company as a Full-stack Developer.
      I want to put my creativity to work on projects that have a real impact on users.
      With this same goal in mind, I aspire to deepen my knowledge of web accessibility.</p>
    
    </div>

    </> // Fin du fragment obligatoire
  );
}



  
