
"use client";
import {useState} from 'react';
import "@/app/globals.css";
import styles from'./about.module.css';
import data from '@/data/dialogue.json';

export default function Dialog() {
    const phrases = data[0]["intro"];
    const [compteur, setCompter] = useState(0);
    const [text, setText] = useState(phrases[0]);

    const nextDiag = () => {
  
    let suivant = compteur + 1;
    console.log("compteur :", suivant);
    if (suivant < phrases.length ) {
      setText(phrases[suivant]);
      setCompter(suivant);
    }
  };



  return (

    <> {/* Début du fragment obligatoire */}

  <h1>About me</h1>
  
  <img className={styles.image} src="asset/music.png" alt="" />

  <p id="about-text" className={styles.text} onClick={nextDiag} >{text}</p>
    
    

    </> 
    // parcours et avenir
  );
};