namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Event;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnsEvents()
    {
        Event::factory()->count(3)->create();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewHas('events');
    }
}
