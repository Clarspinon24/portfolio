"use client";
import Link from "next/link";
import Contact from "@/components/Contact";
import styles from "./nav.module.css";

export default function Nav() {

  return (
    <>
      <nav className={styles.navbar}>
        <Link href="/" className={`${styles.home_link} ${styles.lien_page}`}>
          <img src="/asset/home.png" alt="" />
          Home
        </Link>

        <Link href="/projects" className={`${styles.projects_link} ${styles.lien_page}`}>
          <img src="/asset/dossier.png" alt="" />
          Projects
        </Link>

        <Link href="/about" className={`${styles.about_link} ${styles.lien_page}`}>
          <img src="/asset/music.png" alt="" />
          AboutMe 
        </Link>
      </nav>
      <Contact />
    </>
  

    
  );
}