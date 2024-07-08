<div class="upload-section">
    <h2>Dépôt de la déclaration</h2>



    <form id="uploadForm" action="{{ route('depot.store') }}" method="POST" enctype="multipart/form-data" onsubmit="return checkAllDocumentsValid()">
        @csrf
        <ul>
            <li>
                <label for="declarationType">Type de déclaration:</label>
                <div class="declaration">
                    <p>Choix de déclaration :</p>
                    <select id="declarationType" name="declarationType" required>
                        <option value="Declaration_prix_de_transfert">Declaration prix de transfert</option>
                        <option value="Liase_fiscale_Cas_general">Liase fiscale - Cas general</option>
                        <option value="Liase_fiscale_banques">Liase fiscale - Banques</option>
                    </select>
                </div>
            </li>
            <br>
            <hr>
            <br>
            <li>
                <label>Relative à:</label>
                <div class="declaration">
                    <p>Exercice :</p>
                    <select id="exercice" name="exercice" required>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <option value="2019">2019</option>
                        <option value="2018">2018</option>
                        <option value="2017">2017</option>
                        <option value="2016">2016</option>
                    </select>
                </div>
                <div class="declaration">
                    <p>Nature :</p>&nbsp;&nbsp;&nbsp;
                    <select id="natureType" name="natureType" required>
                        <option value="initial">Initial</option>
                        <option value="rectificative">Réctificative</option>
                        <option value="cessation">Pour cessation d'activité</option>
                    </select>
                </div>
                <div class="declaration">
                    <p>Type :</p>&nbsp;&nbsp;
                    <input type="radio" name="type" value="definitif" id="" required>&nbsp;
                    <p>Dépôt définitif</p>&nbsp;&nbsp;
                    <input type="radio" name="type" value="provisoire" id="" required>&nbsp;
                    <p>Dépôt provisoire</p>
                </div>
            </li>
        </ul>
        <br>
        <div class="upload-section">
            <table>
                <thead>
                    <tr>
                        <th>Document</th>
                        <th>Code Document</th>
                        <th>Nature Document</th>
                        <th>Format Document</th>
                        <th>Fichier à transférer</th>
                        <th>Validité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>BILAN - ACTIF (CAS GENERAL)</td>
                        <td>F6001</td>
                        <td>Obligatoire</td>
                        <td>XML</td>
                        <td><input type="file" class="xml-upload" name="bilan_actif" accept=".xml" required></td>
                        <td class="validity invalid">✘</td>
                    </tr>
                    <tr>
                        <td>BILAN - PASSIF (CAS GENERAL)</td>
                        <td>F6002</td>
                        <td>Obligatoire</td>
                        <td>XML</td>
                        <td><input type="file" class="xml-upload" name="bilan_passif" accept=".xml" required></td>
                        <td class="validity invalid">✘</td>
                    </tr>
                    <tr>
                        <td>ETAT DE RESULTAT (CAS GENERAL)</td>
                        <td>F6003</td>
                        <td>Obligatoire</td>
                        <td>XML</td>
                        <td><input type="file" class="xml-upload" name="etat_resultat" accept=".xml" required></td>
                        <td class="validity invalid">✘</td>
                    </tr>
                    <tr>
                        <td>ETAT DE FLUX DE TRESORERIE (CAS GENERAL)</td>
                        <td>F6004</td>
                        <td>Obligatoire</td>
                        <td>XML</td>
                        <td><input type="file" class="xml-upload" name="flux_tresorerie" accept=".xml" required></td>
                        <td class="validity invalid">✘</td>
                    </tr>
                    <tr>
                        <td>TABLEAU DE DETERMINATION DU RESULTAT FISCAL PARTIEL</td>
                        <td>F6005</td>
                        <td>Obligatoire</td>
                        <td>XML</td>
                        <td><input type="file" class="xml-upload" name="resultat_fiscal_partiel" accept=".xml" required></td>
                        <td class="validity invalid">✘</td>
                    </tr>
                    <tr>
                        <td>FAITS MARQUANTS DE L'EXERCICE</td>
                        <td>F6007</td>
                        <td>Optionnel</td>
                        <td>XML</td>
                        <td><input type="file" name="faits_marquants" accept=".xml"></td>
                        <td class="validity valid">✔</td>
                    </tr>
                    <tr>
                        <td>AUTRES FEUILLES - LIASSE - ANNEXES</td>
                        <td>F6019</td>
                        <td>Optionnel</td>
                        <td>PDF</td>
                        <td><input type="file" name="autres_feuilles" accept=".pdf"></td>
                        <td class="validity valid">✔</td>
                    </tr>
                </tbody>
            </table>
            <button type="submit" class="declarer">Déclarer</button>
        </div>
    </form>
</div>
