
import Link from "next/link";
import projetsData from "@/data/projets.json";
import styles from './projects.module.css';

export default function Projet() {
  return (
    <div className={styles.container}>

      <h1 className={styles.titre}>Mes Réalisations</h1>

      <div className={styles.article}>
          {projetsData.map((projet, index) => (
            <div key={index} className={styles.deco}>
              <article className={styles.card}> 
                <div className={styles.description}>
                  <p>Title: {projet.titre}</p>
                  <p>Description :</p>
                  <p>{projet.description}</p>
                  <a href={projet.lien}>Voir le projet</a>
                </div>
                <Link href={`/projects/details/${index}`} className={styles.etoile}>
                </Link>
              </article>
            </div>
          ))}
        </div>
      </div>

  );
}

