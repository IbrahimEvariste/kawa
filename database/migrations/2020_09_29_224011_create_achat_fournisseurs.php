<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchatFournisseurs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achat_fournisseurs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('denomination')->nullable();
            $table->string('sigle')->nullable();
            $table->string('secteur_activite')->nullable();
            $table->string('rccm')->nullable();
            $table->string('cnps')->nullable();
            $table->string('cpt')->nullable();
            $table->string('adresse_postale')->nullable();
            $table->string('adresse_geo')->nullable();
            $table->string('telephone_entreprise')->nullable();
            $table->string('email_entreprise')->nullable();
            $table->string('fax')->nullable();
            $table->string('siteweb')->nullable();
            $table->string('fonction')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenoms')->nullable();
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->string('part_marche')->nullable();
            $table->string('taux_croissance')->nullable();
            $table->string('chaine_valeur')->nullable();
            $table->string('certification')->nullable();
            $table->string('sous_traitant')->nullable();
            $table->string('condition')->nullable();
            $table->string('mode_paiement')->nullable();
            /*$table->string('societe')->nullable();
            $table->string('civilite')->nullable();
            $table->string('nom')->nullable();
            $table->string('prenom')->nullable();
            $table->string('adresse')->nullable();
            $table->string('pays')->nullable();
            $table->string('telephone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->nullable();
            $table->text('observation')->nullable();
            $table->string('domaine')->nullable();
            $table->string('delaiLivraison')->nullable();
            $table->string('conditionPaiement')->nullable();
            $table->string('numeroAgrement')->nullable();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achat_fournisseur');
    }
}
