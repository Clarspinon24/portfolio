
import Link from "next/link";
import projetsData from "@/data/projets.json";
import styles from './projects.module.css';

export default function Projet() {
  return (
    <div className={styles.container}>
    <img
      className={styles.fond_pro}
      src="/asset/fond_projectsA4.png"
      alt="fond imitant la mer"/>

       <div className={styles.article}>
        <h1 className={styles.titre}>Mes Réalisations</h1>
          {projetsData.map((projet, index) => (
            <div key={index} className={styles.deco}>
              <article className={styles.card}> 
                <img className={styles.illu} src={projet.image} alt={projet.titre} />
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

