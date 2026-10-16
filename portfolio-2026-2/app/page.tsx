"use client"; // Obligatoire pour le onClick
import { useState } from "react";
import "./globals.css";
import styles from "./home.module.css";
import Link from "next/link";

export default function Home() {
  const [isPopped, setIsPopped] = useState(false);

  const handlePop = () => {
    setIsPopped(true);
    // Optionnel : si tu veux que la bulle réapparaisse après 1s
    // setTimeout(() => setIsPopped(false), 1000); 
  };

  return (
    <>
      <img className={styles.background} src="/asset/bureau.jpg" alt="Portfolio" />
      <div className={styles.icons}>
     

        <Link href="/projects" className={`${styles.projects_link} ${styles.lien_page}`}>
          <img src="/asset/dossier.png" alt="" />
          Projects
        </Link>

        <Link href="/about" className={`${styles.about_link} ${styles.lien_page}`}>
          <img src="/asset/music.png" alt="" />
          AboutMe 
        </Link>
      </div> 
    </>
  );
}