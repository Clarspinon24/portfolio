import projetsData from "@/data/projets.json";
import { notFound } from "next/navigation";
import Link from "next/link";


 export default async function Details({ params }: { params: Promise<{ id: string }> }) {
    const { id } = await params;
    const index = parseInt(id);
    const projet = projetsData[index];
    if (!projet) return notFound();

  return (
    <>
      <Link href="/projects" className="retour">← retour</Link>
        <h1>{projet.titre}</h1>
        <div className="details">  


            <iframe className="video"
              src={projet.video} 
              title={projet.titre}
              frameBorder="0"
              allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
              referrerPolicy="strict-origin-when-cross-origin"
              allowFullScreen
            ></iframe> 

        
           <div className="description">
                <p className="text-detail">Date de  début : {projet.date_debut}</p>
                <p className="text-detail">Date de fin : {projet.date_fin}</p>
                <p className="text-detail"> Description : {projet.description}</p>
          {projet.lien && ( /* Pour executer même si le lien projet n'est pas défini*/
              <Link className="text-detail" href={projet.lien}>
                lien GitHub
              </Link>
            )}

           </div>
          
          </div>
        
  </>
        );
}