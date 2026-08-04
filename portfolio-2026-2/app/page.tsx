"use client"; // Obligatoire pour le onClick
import { useState } from "react";
import "./globals.css";

export default function Home() {
  const [isPopped, setIsPopped] = useState(false);

  const handlePop = () => {
    setIsPopped(true);
    // Optionnel : si tu veux que la bulle réapparaisse après 1s
    // setTimeout(() => setIsPopped(false), 1000); 
  };

  return (
    <>
      <img className="siren" src="/asset/Siren2.png" alt="Portfolio" />

    </>
  );
}