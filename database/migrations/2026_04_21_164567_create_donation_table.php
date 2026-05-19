    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up(): void
        {
            Schema::create('donation', function (Blueprint $table) {
                $table->id('donation_id');
                $table->foreignId('user_id')->constrained('users', 'user_id')->onDelete('cascade');
                $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+','O-']);
                $table->enum('gender', ['Male', 'Female']);
                $table->enum('blood_components', ['Whole Blood', 'Platelets', 'Plasma']);
                $table->integer('units_donated');
                $table->decimal('hemoglobin_level', 4,2);
                $table->date('donation_date')->useCurrent();
                $table->decimal('weight_kg', 5,2);
                $table->date('last_donation_date')->nullable();
                $table->text('medical_condition')->nullable();
                $table->foreignId('hospital_id')->constrained('hospital', 'hospital_id')->onDelete('cascade');
                $table->timestamps();
                $table->enum('status', ['Screening', 'Approved', 'Rejected']);
                $table->softDeletes();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('donation');
        }
    };
