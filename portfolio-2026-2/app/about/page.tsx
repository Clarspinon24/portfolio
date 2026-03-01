import "../globals.css";
import styles from'./about.module.css';
import Image from "next/image";

export default function Parcours() {
  return (

    <> {/* Début du fragment obligatoire */}

   <h1>About me</h1>
  <Image 
        className={styles.background}
        src="/asset/bg2.png"
        alt="Picture of way to go the job developer full-stack"
        width={1600}
        height={950}
      />
  
<button id={styles.item1} className={styles.block}>
  Start : Salon Etudiant 2021
</button>

<button id={styles.item2} className={styles.block}>
  Porte Ouverte
</button>

<button id={styles.item3} className={styles.block}>
  Jump In Tech
</button>

<button id={styles.item4} className={styles.block}>
  Stage à la Mairie
</button>

<button id={styles.item5} className={styles.block}>
  IIM Digital School
</button>

<button id={styles.item6} className={styles.block}>
  Coding Park
</button>

<button id={styles.item7} className={styles.block}>
Stage  2-4 mois
</button>

<button id={styles.item8} className={styles.block}>
  alternance
</button>



    

    </> // Fin du fragment obligatoire
  );
}
// /* 
//   Parcours professionnel -> 
//   Compétences détaillées ->
// */