<?php

namespace AppBundle\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Post
 *
 * @ORM\Table(name="post")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PostRepository")
 */
class Post implements \JsonSerializable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="This field can not be empty")
     * @Assert\Length(min="5", minMessage="This field can not be less than 5 characters")
     *
     * @ORM\Column(name="titlePost", type="string", length=255)
     */
    private $titlePost;

    /**
     * @var string
     * @Assert\NotBlank(message="This field can not be empty")
     * @Assert\Length(min="30", minMessage="This field can not be less than 30 characters")
     *
     * @ORM\Column(name="textPost", type="text")
     */
    private $textPost;

    /**
     * @var string
     * @Gedmo\Slug(fields={"titlePost"})
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     *
     * @ORM\Column(name="updateAt", type="datetime")
     */
    private $updateAt;

    /**
     * @var float
     *
     * @ORM\Column(name="rating", type="float")
     */
    private $rating;

    /**
     * @var string
     * @Assert\File(
     *              maxSize = "3M",
     *              mimeTypes = {"image/*"},
     *              maxSizeMessage = "The file is too large ({{ size }}).Allowed maximum size is {{ limit }}",
     *              mimeTypesMessage = "The mime type of the file is invalid ({{ type }}). Allowed mime types are {{ types }}"
     *              )
     */

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="posts")
     */
    private $author;

    function jsonSerialize()
    {
        return [
            'titlePost' => $this->getTitlePost(),
            'textPost' => $this->getTextPost(),
            'slug' => $this->getSlug(),
            'createdAt' => $this->getCreatedAt(),
            'author' => $this->getAuthor()
        ];
    }

    /**
     *
     */




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
     * Set titlePost
     *
     * @param string $titlePost
     *
     * @return Post
     */
    public function setTitlePost($titlePost)
    {
        $this->titlePost = $titlePost;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor(User $author = null)
    {
        $this->author = $author;
    }



    /**
     * Get titlePost
     *
     * @return string
     */
    public function getTitlePost()
    {
        return $this->titlePost;
    }

    /**
     * Set textPost
     *
     * @param string $textPost
     *
     * @return Post
     */
    public function setTextPost($textPost)
    {
        $this->textPost = $textPost;

        return $this;
    }

    /**
     * Get textPost
     *
     * @return string
     */
    public function getTextPost()
    {
        return $this->textPost;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Post
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Post
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updateAt
     *
     * @param \DateTime $updateAt
     *
     * @return Post
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    /**
     * Get updateAt
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }


    /**
     * @return float
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param float $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }




}
