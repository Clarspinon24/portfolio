import Link from "next/link";
 
export default function Sidebar() {
 
  return (
    <div className="sidebar" >  
        
    <Link href="/" className="lien_page" >Accueil</Link>

    <Link href="/projects" className="lien_page">Projet</Link>

    <Link href="/about" className="lien_page">Parcours</Link>

    <Link href="/contact" className="lien_page" >Contact</Link>

    </div>

    
  );
}