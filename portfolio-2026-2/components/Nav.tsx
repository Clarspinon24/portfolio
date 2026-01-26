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
        
    <Link href="/" className="lien_page" >Home</Link>

    <Link href="/projects" className="lien_page">Projects</Link>

    <Link href="/about" className="lien_page">About Me</Link>

    <Link href="/contact" className="lien_page" >Contact</Link>

    </nav>

    
  );
}