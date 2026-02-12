"use client"; 

import { useState } from "react"; 
import Link from "next/link";

export default function Sidebar() {
  const [isOpen, setIsOpen] = useState(false);


  const toggleSidebar = () => {
    setIsOpen(!isOpen);
  };

  return (
    <>
      <button onClick={toggleSidebar} className="Launch">
        <p className="text">Menu</p>
        <div className="background"></div>
      </button>

      <div className={`sidebar ${isOpen ? "open" : ""}`}>
        <Link href="/" className="lien_page">Accueil</Link>
        <Link href="/projects" className="lien_page">Projet</Link>
        <Link href="/about" className="lien_page">Parcours</Link>
        <Link href="/contact" className="lien_page">Contact</Link>
      </div>
    </>
  );
}