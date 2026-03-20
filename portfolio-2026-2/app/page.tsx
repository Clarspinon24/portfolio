"use client"; // Obligatoire pour le onClick
import ChatBot from "@/components/ChatBot";
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

      <div 
        className={`bubble ${isPopped ? 'popped' : ''}`} 
        id="myBubble" 
        onClick={handlePop}
      >
        <p>Je m'appelle Clara Marchal</p>
        <p>
          My professional goal is to join an innovative company as a Full-stack Developer.
          I want to put my creativity to work on projects that have a real impact on users.
          With this same goal in mind, I aspire to deepen my knowledge of web accessibility.
        </p>
        <div className="burst-effect"></div>
      </div>

      <div className="bubble2" id="skills">
        <h3>Compétences</h3>
        <ul>
          <li>Next.js</li>
          <li>React</li>
          <li>SQL</li>
          <li>Symfony</li>
          <li>Python</li>
          <li>PHP</li>
        </ul>
        <a href="/about">lire la suite ...</a>
      </div>

      <div className="chatbot">
         <ChatBot />
      </div>
     

    </>
  );
}