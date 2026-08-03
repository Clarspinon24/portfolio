"use client";
import Link from "next/link";
import Contact from "@/components/Contact";

export default function Nav() {

  return (
    <> 
    <nav >  
        
    <Link href="/" className="lien_page" >Home</Link>

    <Link href="/projects" className="lien_page">Projects</Link>

    <Link href="/about" className="lien_page">About Me</Link>

    </nav>
    
    <Contact />
    
    </>
  

    
  );
}