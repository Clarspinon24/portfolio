"use client";
import Link from "next/link";
import Contact from "@/components/Contact";
import styles from "./nav.module.css";

export default function Nav() {

  return (
    <>
      <nav className={styles.navbar}>
        <Link href="/" className={`${styles.home_link} `}>
          <img src="/asset/home.png" alt="" />
      
        </Link>

        <Link href="/projects" className={`${styles.projects_link} ${styles.lien_page}`}>
          <img src="/asset/dossier.png" alt="" />
         
        </Link>

        <Link href="/about" className={`${styles.about_link} ${styles.lien_page}`}>
          <img src="/asset/music.png" alt="" />
     
        </Link>
      </nav>     
   
    
      <Contact />
    </>
  

    
  );
}