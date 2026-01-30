import "../globals.css";
import Image from "next/image";

export default function Parcours() {
  return (

    <> {/* Début du fragment obligatoire */}

   <h1>Parcours</h1>
        <Image 
        className="background"
        src="/asset/parcours.png"
        alt="Picture of way to go the job developer full-stack"
        width={1600}
        height={950}
      />
  
<button id="item1" className="block">
  Start : Salon Etudiant 2021
</button>

<button id="item2" className="block">
  Porte Ouverte
</button>

<button id="item3" className="block">
  Jump In Tech
</button>

<button id="item4" className="block">
  Stage à la Mairie
</button>

<button id="item5" className="block">
  IIM Digital School
</button>

<button id="item6" className="block">
  Coding Park
</button>

<button id="item7" className="block">
Stage Professionnalisant
</button>

<button id="item8" className="block">
  alternance
</button>


    


    

    </> // Fin du fragment obligatoire
  );
}
// /* 
//   Parcours professionnel -> 
//   Compétences détaillées ->
// */