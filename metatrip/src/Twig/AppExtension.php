<?php 
namespace App\Twig;

use Doctrine\ORM\EntityManagerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use App\Entity\Variables;
use App\Entity\VoyageOrganise;

class AppExtension extends AbstractExtension
{
  private $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }

  public function getFunctions()
  {
    return [
      new TwigFunction('showL', [$this, 'showL'])
    ];
  }

  public function showL($idv)
  {
 
    $repository = $this->entityManager->getRepository(VoyageOrganise::class);
    return $repository->findMapByVoy($idv);
  }
}