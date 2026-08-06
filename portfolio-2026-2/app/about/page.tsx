import "../globals.css";
import styles from'./about.module.css';

export default function Parcours() {
  return (

    <> {/* Début du fragment obligatoire */}

  <h1>About me</h1>
  
  <img className={styles.image} src="asset/music.png" alt="" />

  <p className={styles.text}>Hello, my name is Clara</p>
    

    </> // Fin du fragment obligatoire
  );
}