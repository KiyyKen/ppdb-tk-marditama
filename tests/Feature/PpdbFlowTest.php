<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Pendaftaran;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PpdbFlowTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public homepage is accessible.
     */
    public function test_homepage_is_accessible(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /**
     * Test login page is accessible.
     */
    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    /**
     * Test unauthenticated access to admin dashboard redirects to login.
     */
    public function test_unauthenticated_user_cannot_access_admin(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    /**
     * Test authenticated admin can access admin dashboard.
     */
    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = User::create([
            'username' => 'testadmin',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Administrator');
    }

    /**
     * Test creating new registration assigns unique registration code.
     */
    public function test_pendaftaran_generates_unique_code(): void
    {
        $pendaftaran = Pendaftaran::create([
            'nama_anak' => 'Ahmad Syahputra',
            'jenis_kelamin' => 'L',
            'ttl' => 'Jakarta, 1 Januari 2021',
            'agama' => 'Islam',
            'alamat' => 'Jl. Merdeka No. 10',
            'nama_ortu' => 'Budi Syahputra',
            'pekerjaan' => 'Karyawan',
            'no_hp' => '081234567890',
            'email' => 'budi@example.com',
            'foto' => 'uploads/foto/sample.jpg',
            'akta' => 'uploads/akta/sample.pdf',
            'kk' => 'uploads/kk/sample.pdf',
            'status' => 'pending',
        ]);

        $this->assertNotEmpty($pendaftaran->kode_pendaftaran);
        $this->assertStringStartsWith('PPDB-', $pendaftaran->kode_pendaftaran);
    }
}
