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
    <div>
        <img
      className={styles.fond_pro}
      src="/asset/fond_projectsA4.png"
      alt="fond imitant la mer"
     
    />
      <Link href="/projects" className={styles.retour}>← retour</Link>
        <h1>{projet.titre}</h1>
        <div className="details">  


            <iframe className={styles.video}
              src={projet.video} 
              title={projet.titre}
              frameBorder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerPolicy="strict-origin-when-cross-origin"
              allowFullScreen
            ></iframe> 

        
           <div className={styles.description}>   
            
            {projet.video && ( 
              <Link className={styles.text_detail} href={projet.video}>
                Lien de la vidéo 
              </Link>
            )}
                <p className={styles.text_detail}>Date de  début : {projet.date_debut}</p>
                <p className={styles.text_detail}>Date de fin : {projet.date_fin}</p>
                <p className={styles.text_detail}> Description : {projet.description}</p>
       

          {projet.lien && ( 
              <Link className={styles.text_detail} href={projet.lien}>
                lien GitHub
              </Link>
            )}

           </div>
          
          </div>
        
  </div>
        );
}