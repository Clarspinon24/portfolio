import "../globals.css";
import Link from "next/link";
import projetsData from "@/data/projets.json";

export default function Projet() {
  return (
   <> {/* Début du fragment obligatoire */}
    <div>
      <h1>Mes Réalisations</h1>
      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        {projetsData.map((projet, index) => (
          <div key={index} className="déco">
            
          <article> 
            <img className="illu" src={projet.image}/>
            <div className="description">
              <p>Title: {projet.titre}</p>
              <p> Description :</p>
              <p>{projet.description}</p>
                <a href={projet.lien}></a>
            </div>
              <Link href={`/projects/details/${index}`} className="etoile"></Link>
          </article>
        </div>
        ))}
      </div>
    </div>


    

    </> // Fin du fragment obligatoire
  );
}


