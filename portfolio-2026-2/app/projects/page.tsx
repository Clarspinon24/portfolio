import "../globals.css";
import Link from "next/link";

export default function Projet() {
  return (

    <> {/* Début du fragment obligatoire */}
  
    <h1> PROJECTS </h1>
      <h2>2024</h2>

      <div className="déco">
        <article>
          <iframe
            src="https://www.youtube.com/embed/r8Jd-Z3Debo"
            title="YouTube video player"
            frameBorder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerPolicy="strict-origin-when-cross-origin"
            allowFullScreen
          ></iframe>
          <p className="titre_video">Titre: Mon premier site web</p>
          <div className="description">
            <p> <samp>Titre:</samp> Mon premier site web</p>
            <p> <samp>Date :</samp> 10/12/2025</p>
            <p> <samp>Description :</samp></p>
            <p>haefbuaqbfiabfiaqbfiqebfiqebfiue</p>
            <p>en cfkzednvzkjvbkzb vkjzbvvlbskdv</p>
          </div>
           <Link href="/projects/details" className="etoile"></Link>
        </article>
      </div>

      <div className="déco">
        <article>
          <iframe
            src="https://youtube.com/embed/fNZiUldpTA8"
            title="YouTube video player"
            frameBorder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerPolicy="strict-origin-when-cross-origin"
            allowFullScreen
          ></iframe>
          <p className="titre_video">Titre: Bourse au Projet</p>
          <div className="description">
            <p>Titre: Bourse au Projet</p>
            <p>Date : 10/12/2025</p>
            <p>Description :</p>
            <p>haefbuaqbfiabfiaqbfiqebfiqebfiue</p>
            <p>en cfkzednvzkjvbkzb vkjzbvvlbskdv</p>
          </div>  
          
          <Link href="/projects/details" className="etoile"></Link>
        </article>
      </div>


        <h2>2025</h2>


      <div className="déco">
        <article>
          <iframe
            src="https://www.youtube.com/embed/iukaQfE71R4"
            title="YouTube video player"
            frameBorder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerPolicy="strict-origin-when-cross-origin"
            allowFullScreen
          ></iframe>
          <p className="titre_video">Titre: Pokemon</p>
          <div className="description">
            <p>Titre: Pokemon</p>
            <p>Date : 10/12/2025</p>
            <p>Description :</p>
            <p>haefbuaqbfiabfiaqbfiqebfiqebfiue</p>
            <p>en cfkzednvzkjvbkzb vkjzbvvlbskdv</p>
          </div>
           <Link href="/projects/details" className="etoile"></Link>
        </article>
      </div>

      <div className="déco">
        <article>
          <iframe
            src="https://www.youtube.com/embed/WsUCny970qc?si=UT48XeEc2LnwKjpJ"
            title="YouTube video player"
            frameBorder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerPolicy="strict-origin-when-cross-origin"
            allowFullScreen
          ></iframe>
          <p className="titre_video">Titre: Mon premier site web</p>
          <div className="description">
            <p>Titre: NatureQuest</p>
            <p>Date : 10/12/2025</p>
            <p>Description :</p>
            <p>haefbuaqbfiabfiaqbfiqebfiqebfiue</p>
            <p>en cfkzednvzkjvbkzb vkjzbvvlbskdv</p>
          </div>
           <Link href="/projects/details" className="etoile"></Link>
        </article>
      </div>

        <h2>2026</h2>


      <div className="déco">
        <article>
          <iframe
            src="https://www.youtube.com/embed/WsUCny970qc?si=UT48XeEc2LnwKjpJ"
            title="YouTube video player"
            frameBorder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
            referrerPolicy="strict-origin-when-cross-origin"
            allowFullScreen
          ></iframe>
          <p className="titre_video">Titre: NatureQuest</p>
          <div className="description">
            <p>Titre: NatureQuest</p>
            <p>Date : 10/12/2025</p>
            <p>Description :</p>
            <p>haefbuaqbfiabfiaqbfiqebfiqebfiue</p>
            <p>en cfkzednvzkjvbkzb vkjzbvvlbskdv</p>
          </div>
          <Link href="/projects/details" className="etoile"></Link>
        </article>
      </div>
    </> // Fin du fragment obligatoire
  );
}