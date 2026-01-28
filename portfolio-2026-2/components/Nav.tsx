"use client";
 
import Link from "next/link";

 
export default function Nav() {

  return (
    <nav >  
        
    <Link href="/" className="lien_page" >Home</Link>

    <Link href="/projects" className="lien_page">Projects</Link>

    <Link href="/about" className="lien_page">About Me</Link>

    <Link href="/contact" className="lien_page" >Contact</Link>

    </nav>

    
  );
}