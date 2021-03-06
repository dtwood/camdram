<?php

namespace Acts\CamdramBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Application
 *
 * @ORM\Table(name="acts_applications")
 * @ORM\Entity(repositoryClass="Acts\CamdramBundle\Entity\ApplicationRepository")
 * @Gedmo\Loggable
 */
class Application
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


    /**
     * @var \Show
     *
     * @ORM\ManyToOne(targetEntity="Show", inversedBy="applications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="showid", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     * })
     * @Gedmo\Versioned
     */
    private $show;

    /**
     * @var \Society
     *
     * @ORM\ManyToOne(targetEntity="Organisation", inversedBy="applications")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="socid", referencedColumnName="id", nullable=true, onDelete="CASCADE")
     * })
     * @Gedmo\Versioned
     */
    private $society;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="text", nullable=false)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadlinedate", type="date", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Date()
     * @Gedmo\Versioned
     */
    private $deadlineDate;

    /**
     * @var string
     *
     * @ORM\Column(name="furtherinfo", type="text", nullable=false)
     * @Assert\NotBlank()
     * @Gedmo\Versioned
     */
    private $furtherInfo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="deadlinetime", type="time", nullable=false)
     * @Assert\NotBlank()
     * @Assert\Time()
     * @Gedmo\Versioned
     */
    private $deadlineTime;


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
     * Set text
     *
     * @param string $text
     * @return Application
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set deadline_date
     *
     * @param \DateTime $deadlineDate
     * @return Application
     */
    public function setDeadlineDate($deadlineDate)
    {
        $this->deadlineDate = $deadlineDate;

        return $this;
    }

    /**
     * Get deadline_date
     *
     * @return \DateTime
     */
    public function getDeadlineDate()
    {
        return $this->deadlineDate;
    }

    /**
     * Set further_info
     *
     * @param string $furtherInfo
     * @return Application
     */
    public function setFurtherInfo($furtherInfo)
    {
        $this->furtherInfo = $furtherInfo;

        return $this;
    }

    /**
     * Get further_info
     *
     * @return string
     */
    public function getFurtherInfo()
    {
        return $this->furtherInfo;
    }

    /**
     * Set deadlineTime
     *
     * @param \DateTime $deadlineTime
     * @return Application
     */
    public function setDeadlineTime($deadlineTime)
    {
        $this->deadlineTime = $deadlineTime;

        return $this;
    }

    /**
     * Get deadlineTime
     *
     * @return \DateTime
     */
    public function getDeadlineTime()
    {
        return $this->deadlineTime;
    }

    /**
     * Set show
     *
     * @param \Acts\CamdramBundle\Entity\Show $show
     * @return Application
     */
    public function setShow(\Acts\CamdramBundle\Entity\Show $show = null)
    {
        $this->show = $show;

        return $this;
    }

    /**
     * Get show
     *
     * @return \Acts\CamdramBundle\Entity\Show
     */
    public function getShow()
    {
        return $this->show;
    }

    /**
     * Set society
     *
     * @param \Acts\CamdramBundle\Entity\Organisation $society
     * @return Application
     */
    public function setSociety(Organisation $society = null)
    {
        $this->society = $society;

        return $this;
    }

    /**
     * Get society
     *
     * @return \Acts\CamdramBundle\Entity\Organisation
     */
    public function getSociety()
    {
        return $this->society;
    }
}
