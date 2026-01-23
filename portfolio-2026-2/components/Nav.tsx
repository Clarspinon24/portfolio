"use client";
 
import Link from "next/link";
import { usePathname,  useSearchParams } from "next/navigation";

import { useEffect } from "react";
 
export default function Nav() {
  const pathname = usePathname();
  const searchParams = useSearchParams();
 
  useEffect(() => {
    console.log(searchParams.get("v"));
  }, [searchParams]);

 
  return (
    <nav >  
        
    <Link href="/" className="lien_page" >Accueil</Link>

    <Link href="/projet" className="lien_page">Projet</Link>

    <Link href="/story" className="lien_page">Story</Link>

    <Link href="/parcours" className="lien_page" >Parcours</Link>

    </nav>

    
  );
}