<?php

namespace Acme\StoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Picture
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="QRF\AdminBundle\Entity\PictureRepository")
 */
class Picture
{
   /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */ 
    protected $id;
   /**
     * @var string
     *
     * @ORM\Column(name="pic_path", type="string", length=255)
     */
    private $picPath;

    /**
     * @var string
     *
     * @ORM\Column(name="pic_title", type="string", length=255, nullable=true)
     */
    private $picTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="pic_alt", type="string", length=255, nullable=true, nullable=true)
     *
     */
    private $picAlt;
/**
     * @Assert\File(maxSize="6000000")
     *
     */
    private $picFile;
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
 /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setPicFile(UploadedFile $picFile = null)
    {
        $this->picFile = $picFile;
    }

 /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getPicFile()
    {
        return $this->picFile;
    }
 /**
     * Set picPath
     *
     * @param string $picPath
     * @return Picture
     */
    public function setPicPath($picPath)
    {
        $this->picPath = $picPath;

        return $this;
    }

    /**
     * Get picPath
     *
     * @return string
     */
    public function getPicPath()
    {
        return $this->picPath;
    }

    /**
     * Set picTitle
     *
     * @param string $picTitle
     * @return Picture
     */
    public function setPicTitle($picTitle)
    {
        $this->picTitle = $picTitle;

        return $this;
    }

    /**
     * Get picTitle
     *
     * @return string
     */
    public function getPicTitle()
    {
        return $this->picTitle;
    }

    /**
     * Set picAlt
     *
     * @param string $picAlt
     * @return Picture
     */
    public function setPicAlt($picAlt)
    {
        $this->picAlt = $picAlt;

        return $this;
    }

    /**
     * Get picAlt
     *
     * @return string
     */
    public function getPicAlt()
    {
        return $this->picAlt;
    }

  public function getPicAbsoluteWebPath()
    {
        return null === $this->picPath
            ? null
            : $this->getUploadRootPicDir().'/'.$this->picPath;
    }

    public function getWebPicPath()
    {
        return null === $this->picPath
            ? null
            : $this->getUploadPicDir();
    }

    public function getUploadRootPicDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadPicDir();
    }

    public function getUploadPicDir()
    {
        return 'bundles/adminbundle/img/Pictures/';
    }
  public function upload()
    {
        if (null === $this->getPicFile()) {
            return;
        }

        $this -> getPicFile()->move(
            $this->getUploadRootPicDir(),
            $this->getPicFile()->getClientOriginalName()
        );


        $this->picPath = $this->getUploadPicDir().$this->getPicFile()->getClientOriginalName();

        $this->picFile = null;

    } 
}