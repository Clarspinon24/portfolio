import projetsData from "@/data/projets.json";
import { notFound } from "next/navigation";
import Link from "next/link";
import styles from "./details.module.css";


 export default async function Details({ params }: { params: Promise<{ id: string }> }) {
    const { id } = await params;
    const index = parseInt(id);
    const projet = projetsData[index];
    if (!projet) return notFound();

  return (
    <div className={styles.page}>
 <Link href="/projects" className={styles.retour}><img src="/asset/flecheg.png" alt="retour" /></Link>
    <div className={styles.page1}>

      <img  className={styles.fond_titre} src="/asset/titre.png" alt="" />
        <h1 className={styles.titre}>{projet.titre}</h1>

    <div className={styles.container}>
      <div className={styles.polaroid}>
        <img className={styles.image} src={projet.image} alt="" />
        <img className={styles.polaroid} src="/asset/polaroid.png" alt="" />
      </div>

      <div className={styles.description}>   
                <div className={styles.text_detail}>
                    <article className={styles.card}> 
                      <div className={styles.description}>
                        <p>Description :</p>
                        <p>{projet.description}</p>
                      </div>
                    </article>
                        
                    {projet.lien && ( 
                      <Link className={styles.lien} href={projet.lien}>
                        <img className={styles.lien} src="/asset/tampon_git.png" alt="lien GitHub" />
                      </Link>
                    )}
                </div>

                
      </div>
      </div>
 
    </div>

    <div className={styles.page2}>           
      <div className={styles.detail}>  
                  <iframe className={styles.video}
                    src={projet.video} 
                    title={projet.titre}
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    referrerPolicy="strict-origin-when-cross-origin"
                    allowFullScreen >
                  </iframe> 
                  
              {projet.video && ( 
                      <Link className={styles.lien_video} href={projet.video}>
                        Lien de la vidéo 
                      </Link>
                    )}
           
            </div>
      </div>
    
    </div>
        );
}