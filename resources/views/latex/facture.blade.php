\documentclass[11pt,a4paper]{article}
\usepackage[utf8]{inputenc}
\usepackage[T1]{fontenc}
\usepackage{amsmath}
\usepackage{amsfonts}
\usepackage{amssymb}
\usepackage{lmodern}
\usepackage[left=2cm,right=2cm,top=2cm,bottom=2cm]{geometry}
\begin{document}
\begin{center}
\begin{LARGE}
\textbf{FACTURE}
\end{LARGE}
\end{center}
\begin{center}
\begin{flushleft}
Date: {{$commande->date_cmd}} \\
Nom du client : {{$commande->client->nom}}
\end{flushleft}
\vspace{0.5cm}
\begin{tabular}{|p{1.5cm}|p{10cm}|p{1.5cm}|p{3cm}|}
\hline
Quantité & Désignation & Prix Unitaire & Total \\
\hline
@foreach($commande->lignescommandes as $ligne)
\hline
\hline
{{$ligne->qte_ligne}}&{{$ligne->produit->libelle}} & {{$ligne->produit->prix_unitaire}}& {{$ligne->produit->prix_unitaire}} \\
\hline
@endforeach
\multicolumn{3}{|c|}{Somme totale} & {{$commande->montant_total}} \\\hline
\end{tabular}
\end{center}
\end{document}
