"use client";
 
import { Suspense } from "react";
import Nav from "./Nav";
 
export default function Header() {
  return (
    <Suspense>
      <Nav />
    </Suspense>
  );
}