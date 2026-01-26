import "./globals.css";
import Image from 'next/image'

export default function Home() {
  return (

    <> {/* Début du fragment obligatoire */}
   
   <div className="banderol"><h1 className="affiche">Clara Marchal</h1></div>
         <Image
      src="/asset/siren.png"
      alt="Picture of a siren draw by me"
      width={1600}
      height={950}
    />

    </> // Fin du fragment obligatoire
  );
}



  
