
import Link from "next/link";
import projetsData from "@/data/projets.json";
import styles from './projects.module.css';

export default function Projet() {
  return (
    <div className={styles.container}>
      <div>
        <h1>Mes Réalisations</h1>
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          {projetsData.map((projet, index) => (
            <div key={index} className={styles.deco}> {/* "deco" sans accent */}
              <article className={styles.card}> 
                <img className={styles.illu} src={projet.image} alt={projet.titre} />
                <div className={styles.description}>
                  <p>Title: {projet.titre}</p>
                  <p>Description :</p>
                  <p>{projet.description}</p>
                  {/* Si le lien est vide, l'ancre ne servira à rien, vérifie ton JSON */}
                  <a href={projet.lien}>Voir le projet</a>
                </div>
                <Link href={`/projects/details/${index}`} className={styles.etoile}>
               
                </Link>
              </article>
            </div>
          ))}
        </div>
      </div>
    </div> 
  );
}

